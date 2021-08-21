using Microsoft.AspNetCore.Mvc;
using System;
using System.Xml;

namespace WebFox.Controllers
{
    [Route("api/[controller]")]
    [ApiController]
    public class XxeTest1 : ControllerBase
    {

        [HttpGet("{xmlString}")]
        public void DoXxe(String xmlString)
        {
            XmlDocument xmlDoc = new XmlDocument();
            xmlDoc.LoadXml(xmlString);
        }
    }
}