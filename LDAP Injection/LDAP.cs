using Microsoft.AspNetCore.Http;
using Microsoft.AspNetCore.Mvc;
using System;
using System.Collections.Generic;
using System.Linq;
using System.Threading.Tasks;
using System.DirectoryServices;

namespace WebFox.Controllers
{
    [Route("api/[controller]")]
    [ApiController]
    public class LDAP : ControllerBase
    {
        [HttpGet("{user}")]
        public void LdapInje(string user)
        {
            DirectoryEntry de = new DirectoryEntry("LDAP://DC=mycompany,DC=com");
            DirectorySearcher searcher = new DirectorySearcher(de);
            searcher.Filter = "(&(objectClass=user)(|(cn=" + user + ")(sAMAccountName=" + user + ")))"; //When I'm concatenating the user name, here I got the security flag which is below.

            SearchResult result = searcher.FindOne();
        }
    }
}