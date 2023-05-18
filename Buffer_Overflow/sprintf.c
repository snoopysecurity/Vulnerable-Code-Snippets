#include <stdio.h>
#include <stdlib.h>
 
enum { BUFFER_SIZE = 10 };
 
int main() {
    char buffer[BUFFER_SIZE];
    int check = 0;
 
    sprintf(buffer, "%s", "This string is too long!");
 
    printf external link("check: %d", check); /* This will not print 0! */
 
    return EXIT_SUCCESS;
}
