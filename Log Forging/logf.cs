using Microsoft.AspNetCore.Http;
using Microsoft.AspNetCore.Mvc;
using Microsoft.Extensions.Logging;
using System;
using System.Collections.Generic;
using System.Linq;
using System.Threading.Tasks;

namespace WebFox.Controllers
{
    [Route("api/[controller]")]
    [ApiController]
    public class LogInjection : ControllerBase
    {
        private readonly ILogger<LogInjection> _logger;


        public LogInjection(ILogger<LogInjection> logger)
        {
            _logger = logger;
        }

        [HttpGet("{userInfo}")]
        public void injectLog(string userInfo)
        {
            _logger.LogError("error!! " + userInfo);
        }
    }
}