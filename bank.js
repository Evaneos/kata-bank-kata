export default class {
    operations = [];

    deposit(amount) {
        this.operations = [{
            amount: parseInt(amount),
            date: new Date(),
        }];
    }
}