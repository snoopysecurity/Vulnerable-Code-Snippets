void overflow_function (char *str)
{
  char buffer[20];

  strcpy(buffer, str);  // Function that copies str to buffer
}

int main()
{
  char big_string[128];
  int i;

  for(i=0; i < 128; i++)  // Loop 128 times
  {
    big_string[i] = 'A'; // And fill big_string with 'A's
  }
  overflow_function(big_string);
  exit(0);
}
