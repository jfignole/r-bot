import java.io.*;
import javax.servlet.*;
import javax.servlet.http.*;

public class MailApp extends HttpServlet {

    protected void doPost(HttpServletRequest request, HttpServletResponse response)
            throws ServletException, IOException {
        response.setContentType("text/html;charset=UTF-8");
        PrintWriter out = response.getWriter();

        String to = request.getParameter("to");
        String subject = request.getParameter("subject");
        String message =  request.getParameter("message");
        SendMail.send(to,subject, message);
        out.println("Mail send successfully");
    }
}
