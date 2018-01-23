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
			System.out.println("process="+process);
			// session = request.getSession();
			// synchronized(session){
					dispatcherURL = "/php/login.php";
					if(process == null || process.equals("")){
						dispatcherURL = "/php/shinki.php";
					}else if(process.equals("createUser")){
						dispatcherURL = createUser(request);
					}else if(process.equals("editUser")){
						dispatcherURL = editUser(request);
					}
					request.getRequestDispatcher(dispatcherURL).forward(request,response);
			// }
	}

	// ユーザ追加
	private String createUser(HttpServletRequest request){
		HttpURLConnection uc = null;
		try{
			request.setCharacterEncoding("UTF-8");

			// 変更点:受け渡す項目の追加だけ
			String id = request.getParameter("UserID");
			String family = request.getParameter("FamilyName");
			String family_kana = request.getParameter("FamilyNameKana");
			String given = request.getParameter("GivenName");
			String given_kana = request.getParameter("GivenNameKana");
			String password = request.getParameter("Password");
			String re_password = request.getParameter("PasswordConfirm");
			String postnum = request.getParameter("UserPostNum");
			String pref = request.getParameter("UserAdress");			
			String city = request.getParameter("UserAdress2");
			String address = request.getParameter("UserAdress3");
			String tel = request.getParameter("Usertel");
			String email = request.getParameter("UserMailAdress");
			String flag = request.getParameter("flag");

			String data = "id="+id+"&family="+family+"&family_kana="+family_kana+"&given="+given+"&given_kana="+given_kana+"&password="+password+"&re_password="+re_password+"&postnum="+postnum+"&pref="+pref+"&city="+city+"&address="+address+"&tel="+tel+"&email="+email+"&flag="+flag;
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
			// uc.setRequestProperty("Content-Type","text/html;charset=UTF-8");
			// uc.setRequestProperty("Accept=Language", "ja");

			uc.connect();
			// OutputStreamWriter out = null;
			try{
				OutputStreamWriter out = new OutputStreamWriter(uc.getOutputStream(),"utf-8");
				BufferedWriter bw = new BufferedWriter(out);
				// PrintStream ps = new PrintStream(out);
				bw.write(data);
				// ps.close();
				bw.close();
				out.close();

				// out.flush();
			}catch(IOException e){
				dispatcherURL = "/php/shinki.php";
			}finally{
				// if(out != null){
				// 	out.close();
				// }
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
	
	// ユーザ情報変更
	private String editUser(HttpServletRequest request){
		HttpURLConnection uc = null;
		try{
			request.setCharacterEncoding("UTF-8");

			String id = request.getParameter("id");
			String family = request.getParameter("FamilyName");
			String given = request.getParameter("GivenName");
			String family_kana = request.getParameter("FamilyNameKana");
			String given_kana = request.getParameter("GivenNameKana");
			String tel = request.getParameter("Usertel");
			String email = request.getParameter("UserMailAdress");
			String postnum = request.getParameter("UserPostNum");
			String pref = request.getParameter("UserAdress");			
			String city = request.getParameter("UserAdress2");
			String address = request.getParameter("UserAdress3");
			String username = request.getParameter("username");
			String flag = request.getParameter("flag");

			String data = "id="+id+"&family="+family+"&family_kana="+family_kana+"&given="+given+"&given_kana="+given_kana+"&postnum="+postnum+"&pref="+pref+"&city="+city+"&address="+address+"&tel="+tel+"&email="+email+"&username="+username+"&flag="+flag;
			System.out.println(data);
			URL url = new URL("http://localhost:8080/php/server/usereditserver.php");
			uc = (HttpURLConnection)url.openConnection();
			uc.setDoInput(true);
			uc.setDoOutput(true);
			uc.setRequestMethod("POST");
			// uc.setInstanceFollowRedirects(false);
			// uc.setRequestProperty("Content-Type", "application/x-www-form-urlencoded");
			uc.setReadTimeout(10000);
			uc.setConnectTimeout(20000);
			// uc.setRequestProperty("Content-Type","text/html;charset=UTF-8");
			// uc.setRequestProperty("Accept=Language", "ja");

			uc.connect();
			// OutputStreamWriter out = null;
			try{
				OutputStreamWriter out = new OutputStreamWriter(uc.getOutputStream(),"utf-8");
				BufferedWriter bw = new BufferedWriter(out);
				// PrintStream ps = new PrintStream(out);
				bw.write(data);
				// ps.close();
				bw.close();
				out.close();

				// out.flush();
			}catch(IOException e){
				dispatcherURL = "/php/UserEditMes.php";
			}finally{
				// if(out != null){
				// 	out.close();
				// }
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
						//dispatcherURL = "/php/UserEdit.php?" + br.readLine();
						dispatcherURL = "/php/UserEditMes.php?" + br.readLine();
						break;
					}
					else{
						System.out.println(line);
						dispatcherURL = "/php/UserEditMes.php?" + line;
					}
				}
				br.close();
			}
		}catch(Exception e){
			dispatcherURL = "/php/UserEditMes.php";
			System.out.println(e);

		}finally{
			if(uc != null){
				uc.disconnect();
			}
		}
		return dispatcherURL;	
	}


}