package php;
import java.io.*;
import java.net.*;
import  javax.servlet.*;
import javax.servlet.http.*;
public class OrderController extends HttpServlet{
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
					dispatcherURL = "/php/error.php";
					if(process == null || process.equals("")){
						dispatcherURL = "/php/error.php";
					}
					else if(process.equals("preOrder")){
						dispatcherURL = preOrder(request);
					}else if(process.equals("order")){
						dispatcherURL = userOrder(request);
					}else if(process.equals("order_cancel")){
						dispatcherURL = userOrderCancel(request);
					}
					request.getRequestDispatcher(dispatcherURL).forward(request,response);
			// }
	}

	private String preOrder(HttpServletRequest request){ //予約前のバリデーション
		HttpURLConnection uc = null;
		String upID = request.getParameter("upID");
		String reservation = request.getParameter("reservation");
		try{
			URL url = new URL("http://localhost:8080/php/server/orderserver.php?UpID=" + upID +"&Reservation=" + reservation +"&process=preOrder" );
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
					if(line.equals("error")){
						dispatcherURL = "php/error.php";
					}
					else{
						dispatcherURL = "php/order.php?UpID=" + upID + "&Reservation=" + reservation;
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

	private String userOrder(HttpServletRequest request){
		HttpURLConnection uc = null;
		try{
			String userID = request.getParameter("UserID");
			String upID = request.getParameter("UpID");
			String reservation = request.getParameter("Reservation");

			String data = "UserID="+userID+"&UpID="+upID+"&Reservation="+reservation+"&process=order";

			System.out.println(data);

			URL url = new URL("http://localhost:8080/php/server/postorderserver.php");
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
			// OutputStream out = null;
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
					if(line.equals("error")){
						dispatcherURL = "/php/error.php";
					}
					else{
						dispatcherURL = "/php/order_finish.php";
					}
				}
				br.close();
			}
		}catch(Exception e){
			dispatcherURL = "/php/error.php";
			System.out.println(e);

		}finally{
			if(uc != null){
				uc.disconnect();
			}
		}
		return dispatcherURL;
	}

	private String userOrderCancel(HttpServletRequest request){
		HttpURLConnection uc = null;
		try{
			String userID = request.getParameter("userid");
			String resID = request.getParameter("resID");

			String data = "UserID="+userID+"&ResID="+resID+"&process=order_cancel";

			System.out.println(data);

			URL url = new URL("http://localhost:8080/php/server/postorderserver.php");
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
			// OutputStream out = null;
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
				dispatcherURL = "/php/error.php";
			}finally{
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
					if(line.equals("error")){
						dispatcherURL = "/php/error.php";
					}
					else{
						dispatcherURL = "/php/order_cancel_finish.php";
					}
				}
				br.close();
			}
		}catch(Exception e){
			dispatcherURL = "/php/error.php";
			System.out.println(e);

		}finally{
			if(uc != null){
				uc.disconnect();
			}
		}
		return dispatcherURL;
	}
}
