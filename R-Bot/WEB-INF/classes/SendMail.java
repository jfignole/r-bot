import java.io.*;
import javax.servlet.*;
import javax.servlet.http.*;
import java.util.*;
import javax.mail.*;
import javax.mail.internet.*;

public class MailApp extends HttpServlet {
  public static void send(String to, String user, String sub, String msg ) {
    //create an instance of Properties Class
    Properties props = new Properties();

    /* Specifies the IP address of your default mail server
     	   for e.g if you are using gmail server as an email sever
           you will pass smtp.gmail.com as value of mail.smtp host.
           As shown here in the code.
           Change accordingly, if your email id is not a gmail id
        */
    props.put("mail.smtp.host", "smtp.gmail.com");
    //below mentioned mail.smtp.prot is optional
    props.put("mail.smtp.port", "587");
    props.put("mail.smtp.auth", "true");
    props.put("mail.smtp.starttls.enable", "true");

    /* Pass Properties object(props) and Authenticator object
          for authentication to Session instance
       */


  try{

    //Create an instance of MimeMessage, it accepts MIME types and headers

    MimeMessage message = new MimeMessage(session);
    message.setFrom(new InternetAddress(user));
    message.addRecipient(Message.RecipientType.TO, new InternetAddress(to));
    message.setSubject(sub);
    message.setText(msg);

    /* Transport class is used to deliver the message to the recipients */

       Transport.send(message);
  }
  catch(Exception e)
  {
    e.printStackTrace();
  }
  }
}
