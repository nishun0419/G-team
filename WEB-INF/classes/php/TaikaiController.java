package php;
import java.io.*;
import java.net.*;
import  javax.servlet.*;
import javax.servlet.http.*;
public class TaikaiController extends HttpServlet{
	private String dispatcherURL;
	// private HttpSession session;
	@Override
	public void doGet(HttpServletRequest request, HttpServletResponse response)
					throws ServletException, IOException{

			doPost(request, response);
	}
	@Override
	public void doPost(HttpServletRequest request, HttpServletResponse response)
					throws ServletException, IOException{
			request.setCharacterEncoding("UTF-8");
			String process = request.getParameter("process");
			// session = request.getSession();
			// synchronized(session){
					dispatcherURL = "/php/taikai5.php";
					if(process == null || process.equals("")){
						dispatcherURL = "/php/taikai5.php";
					}
					else if(process.equals("autoLogin")){
						dispatcherURL = loginCheck(request);
					}else if(process.equals("login")){
						dispatcherURL = checkUser(request);
						// dispatcherURL = checkUser(request);
					}else if(process.equals("logout")){
						// session.invalidate();
						dispatcherURL = "/server/logout.php";
					}
					request.getRequestDispatcher(dispatcherURL).forward(request,response);
			// }
	}
	private String loginCheck(HttpServletRequest request){
		HttpURLConnection uc = null;
		String sessionId = request.getParameter("sessionId");
		try{
			URL url = new URL("http://localhost:8080/php/server/logincheck.php?sessionId=" + sessionId);
			uc = (HttpURLConnection)url.openConnection();
			uc.setRequestMethod("GET");
			uc.connect();

			final int status = uc.getResponseCode();
			if(status == HttpURLConnection.HTTP_OK){
				String line;
				InputStream is = uc.getInputStream();
				BufferedReader br = new BufferedReader(new InputStreamReader(is,"utf-8"));
				while ((line = br.readLine()) != null){
					System.out.println(line);
					if(line.equals("false")){
						dispatcherURL = "php/login.php";
					}
					else{
						dispatcherURL = "php/mypage.php";
					}
				}
				br.close();
			}
		}catch(Exception e){
			dispatcherURL = "/php/login.php";
			System.out.println(e);

		}finally{
			if(uc != null){
				uc.disconnect();
			}
		}
		return dispatcherURL;
	}

	private String checkUser(HttpServletRequest request){
		HttpURLConnection uc = null;
		try{
			String id = request.getParameter("id");
			String password = request.getParameter("password");
			String flag = request.getParameter("flag");
			System.out.println(id);
			System.out.println(password);
			String data = "id="+id+"&password="+password+"&flag="+flag;
			URL url = new URL("http://localhost:8080/php/server/loginserver.php");
			uc = (HttpURLConnection)url.openConnection();
			uc.setDoInput(true);
			uc.setDoOutput(true);
			uc.setRequestMethod("POST");
			// uc.setInstanceFollowRedirects(false);
			// uc.setRequestProperty("Content-Type", "application/x-www-form-urlencoded");
			uc.setReadTimeout(10000);
			uc.setConnectTimeout(20000);
			// uc.setRequestProperty("User-Agent", "*");
			// uc.setRequestProperty("Accept=Language", "ja");

			uc.connect();
			OutputStream out = null;
			try{
				out = uc.getOutputStream();
				// BufferedWriter bw = new BufferedWriter(out);
				PrintStream ps = new PrintStream(out);
				ps.print(data);
				ps.close();
				// out.flush();
			}catch(IOException e){
				dispatcherURL = "/php/shinki.php";
			}finally{
				if(out != null){
					out.close();
				}
			}
			// String data = "id="+id;
			// bw.write("id=ninose&password=ninose");
			// bw.close();
			
			final int status = uc.getResponseCode();
			if(status == HttpURLConnection.HTTP_OK){
				String line;
				InputStream is = uc.getInputStream();
				BufferedReader br = new BufferedReader(new InputStreamReader(is,"utf-8"));
				while((line = br.readLine()) != null){
					if(line.equals("false")){
					System.out.println(line);
					dispatcherURL = "/php/taikai5.php?" + br.readLine();
					break;
					}
					else if(line.equals("")){
					dispatcherURL = "/php/taikai5.php";
					}
					else{
						System.out.println(line);
						dispatcherURL = "/php/taikai5.php?" + line;
					}
				}
				br.close();
			}
		}catch(Exception e){
			dispatcherURL = "/php/login.php";
			System.out.println(e);

		}finally{
			if(uc != null){
				uc.disconnect();
			}
		}
		return dispatcherURL;
	}
}