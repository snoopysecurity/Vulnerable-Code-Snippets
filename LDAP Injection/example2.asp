Const LDAP_SERVER = "ldap.example"
userName = Request.QueryString("user")
if( userName = "" ) then
	Response.Write("Invalid request. Please specify a valid user name")
	Response.End()
end if
filter = "(uid=" + CStr(userName) + ")" ' searching for the user entry
Set ldapObj = Server.CreateObject("IPWorksASP.LDAP")
ldapObj.ServerName = LDAP_SERVER
ldapObj.DN = "ou=people,dc=spilab,dc=com"
'Setting the search filter
ldapObj.SearchFilter = filter
ldapObj.Search
While ldapObj.NextResult = 1
	Response.Write("<p>")
	Response.Write("<b><i>User information for: " +
	ldapObj.AttrValue(0) + "</i></b><br>")
	For i = 0 To ldapObj.AttrCount -1
		Response.Write("<b>" + ldapObj.AttrType(i) +"</b>: " +
		ldapObj.AttrValue(i) + "<br>" )
	Next
	Response.Write("</p>")
Wend
Response.Write("<b>" + ldapObj.AttrType(i) +"</b>: " +
ldapObj.AttrValue(i) + "<br>" )
