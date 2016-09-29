import chai, { expect } from 'chai';
import chaiDatetime from 'chai-datetime';
chai.use(chaiDatetime);
import BankAccount from '../bank';
import tk from 'timekeeper';

const expectOperationToBeEqualTo = (actual, expected) => {
    expect(actual.amount).to.equal(expected.amount);
    expect(actual.date).to.equalTime(expected.date);
};

describe('bankAccount', function() {
    let bankAccount;
    beforeEach(() => {
        bankAccount = new BankAccount();
        tk.reset(); // Reset
    });

    it('should not have any operation at the beginning', () => {
        expect(bankAccount.operations).to.have.lengthOf(0);
    });

    describe('#deposit', () => {
        it('should add deposit operation', function() {
            bankAccount.deposit('1000');
            expect(bankAccount.operations).to.have.lengthOf(1);
            expect(bankAccount.operations[0]).to.include({
                amount: 1000
            });
        });
        it('should add deposit operation with a different amount', function() {
            bankAccount.deposit('12000');
            expect(bankAccount.operations[0]).to.include({
                amount: 12000
            });
        });
        it('should save the date of the deposit', function() {
            const dateNow = new Date('2012-10-01');
            tk.freeze(dateNow);
            bankAccount.deposit('1000');
            expect(bankAccount.operations[0].date).to.equalTime(dateNow)
        });
        it('should store successive deposits', function() {
            const dateNow1 = new Date('2012-10-01');
            tk.freeze(dateNow1);
            bankAccount.deposit('1000');
            const dateNow2 = new Date('2012-10-02');
            tk.freeze(dateNow2);
            bankAccount.deposit('2000');

            expect(bankAccount.operations).to.have.lengthOf(2);
            expectOperationToBeEqualTo(bankAccount.operations[0], {
                amount: 1000,
                date: dateNow1,
            });

            expectOperationToBeEqualTo(bankAccount.operations[1], {
                amount: 2000,
                date: dateNow2,
            });
        });
    });

    describe('#withdrawal', () => {
        it('should add withdrawal operation', function() {
            bankAccount.withdrawal('1000');
            expect(bankAccount.operations).to.have.lengthOf(1);
            expect(bankAccount.operations[0]).to.include({
                amount: -1000
            });
        });
        it('should add withdrawal operation with a different amount', function() {
            bankAccount.withdrawal('12000');
            expect(bankAccount.operations[0]).to.include({
                amount: -12000
            });
        });
        it('should save the date of the withdrawal', function() {
            const dateNow = new Date('2012-10-01');
            tk.freeze(dateNow);
            bankAccount.withdrawal('1000');
            expect(bankAccount.operations[0].date).to.equalTime(dateNow)
        });
        it('should store successive withdrawals', function() {
            const dateNow1 = new Date('2012-10-01');
            tk.freeze(dateNow1);
            bankAccount.withdrawal('1000');
            const dateNow2 = new Date('2012-10-02');
            tk.freeze(dateNow2);
            bankAccount.withdrawal('2000');

            expect(bankAccount.operations).to.have.lengthOf(2);
            expectOperationToBeEqualTo(bankAccount.operations[0], {
                amount: -1000,
                date: dateNow1,
            });

            expectOperationToBeEqualTo(bankAccount.operations[1], {
                amount: -2000,
                date: dateNow2,
            });
        });
    });

    it('should store successive deposits and withdrawals', function() {
        bankAccount.deposit('1000');
        bankAccount.withdrawal('2000');

        expect(bankAccount.operations[0].amount).to.be.equal(1000);
        expect(bankAccount.operations[1].amount).to.be.equal(-2000);
    });
});

