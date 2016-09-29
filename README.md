# bank-kata
adaptation des consignes du bank-kata https://github.com/sandromancuso/Bank-kata

# Rules
Your PO gives you as an acceptance test the following scenario:
```
Given a client makes a deposit of 1000 on 10-01-2012
And a deposit of 2000 on 13-01-2012
And a withdrawal of 500 on 14-01-2012
When she prints her bank statement
Then she would see
date || credit || debit || balance
14/01/2012 || || 500.00 || 2500.00
13/01/2012 || 2000.00 || || 3000.00
10/01/2012 || 1000.00 || || 1000.00 
```

The specifications constrain you with this interface (due to business contract between your company and your customers):

>	void deposit(String amount); 

>	void withdrawal(String amount);

>	String getStatement();

implements this product, guided by tests.

# Fun

You can follows the Object Calisthenics rules:

- One level of indentation per method
- Don’t use the ELSE keyword
- Wrap all primitives and Strings
- First class collections
- One dot per line
- Don’t abbreviate
- Keep all entities small (50 lines)
- No classes with more than two instance variables
- No getters/setters/properties

