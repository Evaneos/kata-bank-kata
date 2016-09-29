import formatOperationStatement from './formatOperationStatement';
export default class {
    operations = [];

    deposit(amount) {
        this.operations.push({
            amount: parseInt(amount, 10),
            date: new Date(),
        });
    }

    withdrawal(amount) {
        this.operations.push({
            amount: -parseInt(amount, 10),
            date: new Date(),
        });
    }

    getStatement() {
        return formatOperationStatement(this.operations);
    }

}
