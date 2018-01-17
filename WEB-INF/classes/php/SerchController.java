package php;
import java.io.*;
import java.net.*;
import  javax.servlet.*;
import javax.servlet.http.*;
public class SerchController extends HttpServlet{
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
					dispatcherURL = "/php/serch.php";
					if(process == null || process.equals("")){
						dispatcherURL = "/php/serch.php?keyword=&area=&process=serch&minwidth=&maxwidth=&infra=";
					}
					else if(process.equals("serch")){
						dispatcherURL = "/php/serch.php";
					}
					request.getRequestDispatcher(dispatcherURL).forward(request,response);
			// }
	}

	// private String SerchParamCheck(HttpServletRequest request){
	// 	String keyword = request.getParameter("keyword");
	// 	System.out.println(keyword);
	// 	if(keyword.equals("") || keyword == null){
	// 		return dispatcherURL = "/php/serch.php";
	// 	}
	// 	else{
	// 		return dispatcherURL = "/php/serch.php?keyword=" + keyword;
	// 	}
	// }
}