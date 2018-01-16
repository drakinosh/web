#include <stdio.h>

#define CHAR_HOR '-'
#define CHAR_VERT '|'

int main()
{
    int r = 10;
    int c = 12;

    int i, j;

    for (i=0; i<c; i++) {

        if (i == 0 || i == c-1) {
            for (j = 0; j < r; j++ ) {
                printf("%c", CHAR_HOR);
            }
            printf("\n");

        } else {
            printf("%c", CHAR_VERT);
            for (j = 1; j < r-1; j++) {
                printf(" ");
            }
            printf("%c", CHAR_VERT);
            printf("\n");
        }
        

    }

    printf("\n");

    return 0;
}
