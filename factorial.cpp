#include <math.h>
#include <stdio.h>
#include <iostream>
using namespace std;

int main()
{   int n, result=1, a;
    cout << "Enter the no.";
    cin >> n;
    
    for(int i = n; i > 0; i--){
        result = result * i;
        
    }
    cout<<result;
    return 0;
}
