const formatAmount = amount => {
    const amountString = (Math.round(amount*100) + '');
    return `${amountString.slice(0, -2)}.${amountString.slice(-2)}`;
}

const formatNumberTwoDigits = number => (number < 10 ? '0' : '') + number;
const formatDate = date => `${formatNumberTwoDigits(date.getDate())}/${formatNumberTwoDigits(date.getMonth() + 1)}/${date.getFullYear()}`

const formatOperation = ({ date, amount, total }) => (
    `${formatDate(date)} || ${amount > 0 ? formatAmount(amount) + ' ||' : '|| ' + formatAmount(-amount)} || ${formatAmount(total)}`
);

const enrichOperation = (operations, operation) => {
    const lastTotal = operations.length === 0 ? 0 : operations[operations.length - 1].total;
    operations.push({ ...operation, total: lastTotal + operation.amount });
    return operations;
};

export default operations =>
    [
        'date || credit || debit || balance',
        ...operations.reduce(enrichOperation, []).map(formatOperation).reverse(),
    ].join('\n');
