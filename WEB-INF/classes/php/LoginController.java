package php;
import java.io.*;
import java.net.*;
import  javax.servlet.*;
import javax.servlet.http.*;
public class LoginController extends HttpServlet{
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
						dispatcherURL = "/php/login.php";
					}
					else if(process.equals("autoLogin")){
						dispatcherURL = loginCheck(request);
					}else if(process.equals("login")){
						dispatcherURL = checkUser(request);
						// dispatcherURL = checkUser(request);
					}else if(process.equals("logout")){
						// session.invalidate();
						dispatcherURL = "/server/logout.php";
					}else if(process.equals("order_to_login")){
						String url =request.getParameter("url");
						String upId = request.getParameter("UpID");
						String reservation = request.getParameter("Reservation");
						dispatcherURL = "/php/login.php?url="+url+"&UpID="+upId+"&Reservation="+reservation;
					}else if(process.equals("taikaiForm")){
						dispatcherURL = "/php/taikai5.php";
					}else if(process.equals("taikaiCheck")){
						dispatcherURL = taikaiCheckUser(request);
					}else if(process.equals("taikaiconfirm")){
						dispatcherURL = taikaiComp(request);
					}else if(process.equals("complete")){
						dispatcherURL = "/php/taikaicomp.php";
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
		//予約前の画面遷移に必要な変数
		String orderurl = request.getParameter("url");
		String upid = request.getParameter("upid");
		String reservation = request.getParameter("reservation");
		try{
			String id = request.getParameter("id");
			String password = request.getParameter("password");
			// String flag = request.getParameter("flag");
			System.out.println(id);
			System.out.println(password);
			String data = "id="+id+"&password="+password;
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
						if(orderurl != null){
							dispatcherURL = "/php/login.php?" + br.readLine()+"&url="+orderurl+"&UpID="+upid+"&Reservation="+reservation;
							break;
						}
						else{
							dispatcherURL = "/php/login.php?" + br.readLine();
						}
					}
					else if(line.equals("")){
					dispatcherURL = "/php/login.php";
					}
					else{
						System.out.println(line);
						if(orderurl != null){
							dispatcherURL = orderurl+"?UpID="+upid+"&Reservation="+reservation+"&"+line;
						}
						else{
							dispatcherURL = "/php/mypage.php?" + line;
						}
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
	private String taikaiCheckUser(HttpServletRequest request){
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
						dispatcherURL = "/php/taikaikakunin.php?" + line;
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

	private String taikaiComp(HttpServletRequest request){
		HttpURLConnection uc = null;
		try{
			String id = request.getParameter("id");
			System.out.println(id);
			String data = "id="+id;
			URL url = new URL("http://localhost:8080/php/server/taikaiserver.php");
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
					dispatcherURL = "/php/error.php";
					break;
					}
					else if(line.equals("")){
					dispatcherURL = "/php/error.php";
					}
					else{
						System.out.println(line);
						dispatcherURL = "/server/taikai_session_delete.php";
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