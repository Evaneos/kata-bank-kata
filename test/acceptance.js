import { expect } from 'chai';
import BankAccount from '../bank';
import tk from 'timekeeper';


describe('Acceptance test', function() {
    it('should be able to save client operations and print balance', function() {
        const givenIMakeADepositOf = (amount, date) => {
            tk.freeze(new Date(date));
            bankAccount.deposit(amount);
        };
        const givenIMakeAWithdrawalOf = (amount, date) => {
            tk.freeze(new Date(date));
            bankAccount.withdrawal(amount);
        };
        const bankAccount = new BankAccount();
        givenIMakeADepositOf('1000', '2012-01-10');
        givenIMakeADepositOf('2000', '2012-01-13');
        givenIMakeAWithdrawalOf('500', '2012-01-14');
        expect(bankAccount.getStatement()).to.be.equal(
`date || credit || debit || balance
14/01/2012 || || 500.00 || 2500.00
13/01/2012 || 2000.00 || || 3000.00
10/01/2012 || 1000.00 || || 1000.00`)
    });
});

