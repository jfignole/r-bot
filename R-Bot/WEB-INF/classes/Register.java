import java.io.*;
import java.sql.*;
import javax.servlet.ServletException;
import javax.servlet.http.*;
import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.SQLException;
import javax.sql.DataSource;
import java.net.*;

public class Register extends HttpServlet {

  public void doPost(HttpServletRequest request, HttpServletResponse response) throws ServletException,IOException {

    response.setContentType("text/html;charset=UTF-8");
    PrintWriter out = response.getWriter();

    String fn=request.getParameter("fName");
    String ln=request.getParameter("lName");
    String un=request.getParameter("uName");
    String em=request.getParameter("uEmail");
    String pw=request.getParameter("pass");
    String tp=request.getParameter("uType");
    out.println("Got Parameters");
    //loading drivers for mysql
    try {
      Class.forName("com.mysql.jdbc.Driver");
      out.println("Loaded MySQL Drivers");
      ServerSocket welcomeSocket = new ServerSocket(3307);
      Socket connectionSocket = welcomeSocket.accept();
      out.println("Connected to Socket");
      //creating connection with the database
      String dbName = "r-bot";
      String dbInst = "r-bot";
      String jdbcUrl = "jdbc:mysql://127.0.0.1:3306/r_bot?user=cgi";
      String dbUser = "cgi";
      String dbPass = "";
      Connection con = DriverManager.getConnection(jdbcUrl);
      if (con.isClosed()==false){
      out.println("Connected to Database");
    }
    else
    out.println("Did Not Connect");
     PreparedStatement ps=con.prepareStatement
      ("insert into users values(?,?,?,?,?,?)");

      ps.setString(1,fn);
      ps.setString(2,ln);
      ps.setString(3,un);
      ps.setString(4,em);
      ps.setString(5,pw);
      ps.setString(6,tp);
      int i=ps.executeUpdate();
      out.println("Inserted into database");
      if(i>0)
      {
        out.print("You are successfully registered...");
        con.close();
        out.flush();
        out.close();
      }
      welcomeSocket.close();
      out.println("Socket Closed");
      out.close();
    }
      catch (Exception exc)
      {
        exc.printStackTrace();
      }
      out.flush();
      out.close();
    }
  }
