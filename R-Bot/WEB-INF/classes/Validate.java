import java.sql.*;
import javax.servlet.*;
import javax.servlet.http.*;

public class Validate extends HttpServlet
{
  public static boolean checkUser(String user, String pass, String type)
  {
    boolean st =false;
    try {

      //loading drivers for mysql
      Class.forName("com.mysql.jdbc.Driver");

      //creating connection with the database
      Connection con=DriverManager.getConnection
                      ("jdbc:mysql://localhost:3306/r_bot","root","cgi@1234");
      PreparedStatement ps =con.prepareStatement
                          ("SELECT * FROM users where username=? and pass=?");
      ps.setString(1, user);
      ps.setString(2, pass);
      ps.setString(3, type);
      ResultSet rs =ps.executeQuery();
      st = rs.next();
    }catch(Exception e)
    {
      e.printStackTrace();
    }
      return st;
  }
}
