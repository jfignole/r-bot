import java.io.*;
import java.sql.*;
import javax.servlet.*;
import javax.servlet.http.*;

public class Login extends HttpServlet
{

  protected void doPost(HttpServletRequest request, HttpServletResponse response)
        throws ServletException,IOException
  {
    response.setContentType("text/html;charset=UTF-8");
    PrintWriter out = response.getWriter();

    String user=request.getParameter("uname");
    String pwd=request.getParameter("pass");
    String type=request.getParameter("type");

    if(Validate.checkUser(user, pwd, type))
    {
      if(type.equals("Employee") || type.equals("HR"))
      {
        RequestDispatcher rs = request.getRequestDispatcher("RM_Form.html");
        rs.forward(request, response);
      }
      else
      {
        RequestDispatcher rs = request.getRequestDispatcher("V_Form.html");
        rs.forward(request, response);
      }
    }
    else
    {
      out.println("Username or Password incorrect");
      RequestDispatcher rs = request.getRequestDispatcher("index.html");
      rs.include(request, response);
    }
  }
}
