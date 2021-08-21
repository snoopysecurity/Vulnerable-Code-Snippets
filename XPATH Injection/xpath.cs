using Microsoft.AspNetCore.Mvc;
using System.Xml;

namespace WebFox.Controllers
{
    [Route("api/[controller]")]
    [ApiController]
    public class XPath : ControllerBase
    {
        [HttpGet("{user}")]
        public void XPATH(string user)
        {
            // Load the document and set the root element.  
            XmlDocument doc = new XmlDocument();
            doc.Load("bookstore.xml");
            XmlNode root = doc.DocumentElement;

            // Add the namespace.  
            XmlNamespaceManager nsmgr = new XmlNamespaceManager(doc.NameTable);
            nsmgr.AddNamespace("bk", "urn:newbooks-schema");

            XmlNode node = root.SelectSingleNode(
                "descendant::bk:book[bk:author/bk:last-name='"+user+"']", nsmgr);
        }
    }
}