package org.joychou.controller;


import org.joychou.mapper.UserMapper;
import org.joychou.dao.User;
import org.joychou.security.SecurityUtil;
import org.slf4j.Logger;
import org.slf4j.LoggerFactory;
import org.springframework.beans.factory.annotation.Value;
import org.springframework.web.bind.annotation.*;

import javax.annotation.Resource;
import java.sql.*;
import java.util.List;


@SuppressWarnings("Duplicates")
@RestController
@RequestMapping("/sqli")
public class SIRemoved {

    private static final Logger logger = LoggerFactory.getLogger(SIRemoved.class);

    private static final String driver = "com.mysql.cj.jdbc.Driver";

    @Value("${spring.datasource.url}")
    private String url;

    @Value("${spring.datasource.username}")
    private String user;

    @Value("${spring.datasource.password}")
    private String password;

    @Resource
    private UserMapper userMapper;

    /**
     * <p>Sql injection jbdc security code by using {@link PreparedStatement}.</p><br>
     *
     * <a href="http://localhost:8080/sqli/jdbc/sec?username=joychou">http://localhost:8080/sqli/jdbc/sec?username=joychou</a>
     */
    @RequestMapping("/jdbc/sec")
    public String jdbc_sqli_sec(@RequestParam("username") String username) {

        StringBuilder result = new StringBuilder();
        try {
            Class.forName(driver);
            Connection con = DriverManager.getConnection(url, user, password);

            if (!con.isClosed())
                System.out.println("Connect to database successfully.");

            // fix code
            String sql = "select * from users where username = ?";
            PreparedStatement st = con.prepareStatement(sql);
            st.setString(1, username);

            logger.info(st.toString());  // sql after prepare statement
            ResultSet rs = st.executeQuery();

            while (rs.next()) {
                String res_name = rs.getString("username");
                String res_pwd = rs.getString("password");
                String info = String.format("%s: %s\n", res_name, res_pwd);
                result.append(info);
                logger.info(info);
            }

            rs.close();
            con.close();

        } catch (ClassNotFoundException e) {
            logger.error("Sorry, can't find the Driver!");
            e.printStackTrace();
        } catch (SQLException e) {
            logger.error(e.toString());
        }
        return result.toString();
    }
}
