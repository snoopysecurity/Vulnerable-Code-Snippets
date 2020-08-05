#include <stdio.h>
#include <stdlib.h>
#include <unistd.h>
 
#define MY_TMP_FILE "/tmp/file.tmp"
 
 
int main(int argc, char* argv[])
{
    FILE * f;
    if (!access(MY_TMP_FILE, F_OK)) {
        printf external link("File exists!\n");
        return EXIT_FAILURE;
    }
    /* At this point the attacker creates a symlink from /tmp/file.tmp to /etc/passwd */
    tmpFile = fopen(MY_TMP_FILE, "w");
 
    if (tmpFile == NULL) {
        return EXIT_FAILURE;
    }
 
    fputs("Some text...\n", tmpFile);
 
    fclose(tmpFile);
    /* You successfully overwrote /etc/passwd (at least if you ran this as root) */
 
    return EXIT_SUCCESS;
}
