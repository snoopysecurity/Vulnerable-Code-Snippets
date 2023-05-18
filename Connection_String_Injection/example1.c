int main(int argc, char *argv[])
{
	rc = SQLConnect(Example.ConHandle, argv[0], SQL_NTS,
	(SQLCHAR *) "", SQL_NTS, (SQLCHAR *) "", SQL_NTS);
}
