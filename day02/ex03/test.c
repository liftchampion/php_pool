#include <stdio.h>
#include <stdlib.h>
#include <utmpx.h>

int main(void)
{
	struct utmpx t;
	printf("%zu\n", sizeof(t));
	printf("%zu\n", sizeof(t.ut_user));
	printf("%zu\n", sizeof(t.ut_id));
	printf("%zu\n", sizeof(t.ut_line));
	printf("%zu\n", sizeof(t.ut_pid));
	printf("%zu\n", sizeof(t.ut_type));
	printf("%zu\n", sizeof(t.ut_tv));
	printf("%zu\n", sizeof(t.ut_host));
	printf("%zu\n", sizeof(t.ut_pad));
	return (0);	
}
