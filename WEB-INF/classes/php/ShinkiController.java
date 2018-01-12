package php;
import java.io.*;
import java.net.*;
import javax.servlet.*;
import javax.servlet.http.*;
public class ShinkiController extends HttpServlet{
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
					dispatcherURL = "/php/login.php";
					if(process == null || process.equals("")){
						dispatcherURL = "/php/shinki.php";
					}else if(process.equals("createUser")){
						dispatcherURL = createUser(request);
					}
					request.getRequestDispatcher(dispatcherURL).forward(request,response);
			// }
	}

	private String createUser(HttpServletRequest request){
		HttpURLConnection uc = null;
		try{
			request.setCharacterEncoding("UTF-8");

			// 変更点:受け渡す項目の追加だけ
			String id = request.getParameter("id");
			String family = request.getParameter("family");
			String family_kana = request.getParameter("family_kana");
			String given = request.getParameter("given");
			String given_kana = request.getParameter("given_kana");
			String password = request.getParameter("password");
			String re_password = request.getParameter("re_password");
			String postnum = request.getParameter("postnum");
			String address = request.getParameter("address");
			String tel = request.getParameter("tel");
			String email = request.getParameter("email");
			String re_email = request.getParameter("re_email");
			//TODO:都道府県プルダウン対応 String pref = request.getParameter("pref");
			String data = "id="+id+"&family="+family+"&family_kana="+family_kana+"&given="+given+"&given_kana="+given_kana+"&password="+password+"&re_password="+re_password+"&postnum="+postnum+"&address="+address+"&tel="+tel+"&email="+email+"&re_email="+re_email;
			//TODO:都道府県プルダウン対応 String data = "id="+id+"&family="+family+"&family_kana="+family_kana+"&given="+given+"&given_kana="+given_kana+"&password="+password+"&re_password="+re_password+"&postnum="+postnum+"&address="+address+"&tel="+tel+"&email="+email+"&re_email="+re_email+"&pref="+pref;
			System.out.println(data);
			URL url = new URL("http://localhost:8080/php/server/shinkiserver.php");
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
					dispatcherURL = "/php/shinki.php?" + br.readLine();
					break;
					}
					else{
						System.out.println(line);
						dispatcherURL = "/php/mypage.php?" + line;
					}
				}
				br.close();
			}
		}catch(Exception e){
			dispatcherURL = "/php/shinki.php";
			System.out.println(e);

		}finally{
			if(uc != null){
				uc.disconnect();
			}
		}
		return dispatcherURL;
	}
	
}