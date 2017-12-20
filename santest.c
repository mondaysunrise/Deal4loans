#include<stdio.h>
#include<dlfcn.h>

void main()
{
void *handle;
char temp1[1500];
char temp2[1500];
char *str;
char* (*func)(char*,char*);

puts("Enter the string");
gets(temp1);
puts("enter the key");
gets(temp2);
handle=dlopen("./checksum.so.1",RTLD_LAZY);
func=(char* (*)(char*,char*))dlsym(handle,"Transpo");
str=(char*)malloc(sizeof(char) * 20);
str=(char *)((*func)(temp1,temp2));
printf("STR = %s \n", str);
}
				 
