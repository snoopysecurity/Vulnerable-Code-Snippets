using System.Net;
using System.Security.Cryptography;
using Microsoft.AspNetCore.Http;

namespace WebFox.Controllers
{
    public class SecureCookieTest2
    {
        // HttpCookie myCookie = new HttpCookie("Sensitive cookie");
        public void DoPost(HttpWebResponse response, HttpWebRequest request)
        {
            DoGet(response, request);
        }

        public void DoGet(HttpWebResponse response, HttpWebRequest request)
        {
            Unsafe(response, request);
        }

        public void Unsafe(HttpWebResponse response, HttpWebRequest request)
        {
            string password = "p-" + RandomNumberGenerator.GetInt32(200000000, 2000000000);
            response.Cookies.Add(new Cookie("password", password));
        }
    }
}