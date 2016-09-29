import { expect } from 'chai';
import BankAccount from '../bank';
import formatOperationStatement from '../formatOperationStatement';

describe('formatOperationStatement', function() {
    it('should print headers', function() {
        expect(formatOperationStatement([])).to.be.equal(
            'date || credit || debit || balance'
        );
    });

    it('should print a deposit with the date', function() {
        expect(formatOperationStatement([{
            amount: 500,
            date: new Date('2012-12-13'),
        }])).to.be.equal(
            'date || credit || debit || balance\n' +
            '13/12/2012 || 500.00 || || 500.00'
        );
    });


    it('should print a withdrawal with the date', function() {
        expect(formatOperationStatement([{
            amount: -500,
            date: new Date('2012-12-13'),
        }])).to.be.equal(
            'date || credit || debit || balance\n' +
            '13/12/2012 || || 500.00 || -500.00'
        );
    });

    it('should print several deposits and withdrawals', function() {
        expect(formatOperationStatement([
            { amount: 500, date: new Date('2012-01-13') },
            { amount: 1500, date: new Date('2012-12-04') },
            { amount: -500, date: new Date('2012-12-15') },
        ])).to.be.equal(
            'date || credit || debit || balance\n' +
            '15/12/2012 || || 500.00 || 1500.00\n' +
            '04/12/2012 || 1500.00 || || 2000.00\n' +
            '13/01/2012 || 500.00 || || 500.00'
        );
    });
});

