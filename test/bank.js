import chai, { expect } from 'chai';
import chaiDatetime from 'chai-datetime';
chai.use(chaiDatetime);
import BankAccount from '../bank';

describe('bankAccount', function() {
    let bankAccount;
    beforeEach(() => {
        bankAccount = new BankAccount();
    });
    describe('#deposit', () => {
        it('should not have any operation at the beginning', () => {
            expect(bankAccount.operations).to.have.lengthOf(0);
        })
        it('should add money', function() {
            bankAccount.deposit('1000');
            expect(bankAccount.operations).to.have.lengthOf(1);
            expect(bankAccount.operations[0]).to.include({
                amount: 1000
            });
        });
        it('should add money with a different amount', function() {
            bankAccount.deposit('12000');
            expect(bankAccount.operations[0]).to.include({
                amount: 12000
            });
        });
        it('should save the date of the deposit', function() {
            bankAccount.deposit('1000');
            expect(bankAccount.operations).to.have.lengthOf(1);
            const dateNow = new Date('2012-10-01');
            tk.freeze(dateNow);
            expect(bankAccount.operations[0].date).to.equalTime(dateNow)
        });
    })
});

