import java.io.*;
import java.sql.*;
import javax.servlet.ServletException;
import javax.servlet.http.*;
import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.SQLException;
import javax.sql.DataSource;

public class RMForm extends HttpServlet {

  public void doPost(HttpServletRequest request, HttpServletResponse response) throws ServletException,IOException {

    response.setContentType("text/html;charset=UTF-8");
    PrintWriter out = response.getWriter();

    String ptitle=request.getParameter("ptitle");
    String sloc=request.getParameter("sloc");
    String dsub=request.getParameter("dsub");
    String numres=request.getParameter("numres");
    String pstart=request.getParameter("pstart");
    String tmfp=request.getParameter("TMFP");
    String type=request.getParameter("type");
    String rsdate=request.getParameter("rsdate");
    String rendate=request.getParameter("rendate");
    String proj_client=request.getParameter("proj_client");
    String conf_perc=request.getParameter("conf_perc");
    String hir_manag=request.getParameter("hir_manag");
    String sen_manag=request.getParameter("sen_manag");
    String engag_manag=request.getParameter("engag_manag");
    String pcode=request.getParameter("pcode");
    String t_sal=request.getParameter("t_salary");
    String rcc_lvl=request.getParameter("rcc_level");
    String pos_desc=request.getParameter("posit_desc");
    String rec_hire=request.getParameter("rec_hire");
    String notes=request.getParameter("notes");
    out.println("Got Parameters");
    //loading drivers for mysql
    try {
      Class.forName("com.mysql.jdbc.Driver");
      out.println("Loaded MySQL Drivers");
      //creating connection with the database
      Connection con = DriverManager.getConnection("jdbc:mysql://localhost:3306/r_bot?user=root&password=cgi@1234");
      if (con.isClosed()==true){
      out.println("Connected to Database");
    }
    else
    out.println("Did Not Connect");
      PreparedStatement ps=con.prepareStatement
      ("insert into r_bot.rmemform values(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");

      ps.setString(1,ptitle);
      ps.setString(2,sloc);
      ps.setString(3,dsub);
      ps.setString(4,numres);
      ps.setString(5,pstart);
      ps.setString(6,tmfp);
      ps.setString(7,type);
      ps.setString(8,rsdate);
      ps.setString(9,rendate);
      ps.setString(10,proj_client);
      ps.setString(11,conf_perc);
      ps.setString(12,hir_manag);
      ps.setString(13,sen_manag);
      ps.setString(14,engag_manag);
      ps.setString(15,pcode);
      ps.setString(16,t_sal);
      ps.setString(17,rcc_lvl);
      ps.setString(18,pos_desc);
      ps.setString(19,rec_hire);
      ps.setString(20,notes);

      int i=ps.executeUpdate();
      out.println("Inserted into database");
      if(i>0 && i <=20)
      {
        out.print("RM_Form Complete");
        MailApp mail = new MailApp();
        mail.doPost(request, response);
        con.close();
        out.flush();
        out.close();
      }
      con.close();
    }
      catch (Exception exc)
      {
        exc.printStackTrace();
      }

      out.flush();
      out.close();
    }
  }
