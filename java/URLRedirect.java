package org.controller;

import org.springframework.stereotype.Controller;
import org.springframework.web.bind.annotation.GetMapping;
import org.springframework.web.bind.annotation.RequestMapping;
import org.springframework.web.bind.annotation.RequestParam;
import org.springframework.web.bind.annotation.ResponseBody;

import javax.servlet.RequestDispatcher;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;
import java.io.IOException;

@Controller
@RequestMapping("/urlRedirect")
public class URLRedirect {

    /**
     * http://localhost:8080/urlRedirect/redirect?url=http://www.baidu.com
     */
    @GetMapping("/redirect")
    public String redirect(@RequestParam("url") String url) {
        return "redirect:" + url;
    }
}
