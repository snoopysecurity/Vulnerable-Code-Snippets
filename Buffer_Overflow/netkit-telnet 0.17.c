/*
netkit-telnet 0.17 BUFFER OVERFLOW
telnet stack smashing bug, in a completely unrelated part of DISPLAY= handling to the last one... from netkit-telnet 0.17 - when passing unix:arg or ":arg" in DISPLAY the argument is strcat() onto a fixed stack 256 byte buffer


*/


static void env_fix_display(void) {
enviro *ep = env_find("DISPLAY");
if (!ep) return;
ep->setexport(1);
if (strncmp(ep->getval(), ":", 1) && strncmp(ep->getval(), "UNIX", 5)) {
return;
}
char hbuf{256];
const char *cp2 = strrchr(ep->getval(), ':');
int maxlen = sizeof(hbuf)-strlen(cp2)-1;
gethostname(hbuf, maxlen);
hbuf[maxlen] = 0;
if (!strehr(hbuf, '.')) {
struct hostent *h = gethostbyname(hbuf);
if (h) {}
strncpy(hbuf, h->h_name, maxlen);
hbuf(maxlen] = 0;
}
}
strcat(hbuf, cp2);
ep->define("DISPLAY", hbuf);
}
