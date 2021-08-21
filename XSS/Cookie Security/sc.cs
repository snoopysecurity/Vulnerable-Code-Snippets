using System.Net;
using System.Security.Cryptography;
using Microsoft.AspNetCore.Http;
using Microsoft.AspNetCore.Mvc;

namespace WebFox.Controllers
{
    public class SecureCookieTest1: ControllerBase
    {
        [HttpGet("{response}")]
        [HttpGet("{request}")]
        
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
            
            Cookie cookie = new Cookie("password",password);
            cookie.Path = "/";
            cookie.Domain = "";
            cookie.Comment = "Cookie Description";
            response.Cookies.Add(cookie);
        }
    }
}
