const formatAmount = amount => {
    const amountString = (Math.round(amount*100) + '');
    return `${amountString.slice(0, -2)}.${amountString.slice(-2)}`;
}
const formatDate = date => `${date.getDate()}/${date.getMonth() + 1}/${date.getFullYear()}`

const displayAmountIf = (condition, amount) => condition ? formatAmount(amount) : '';
const formatOperation = ({ date, amount }) =>
    `${formatDate(date)} || ${amount > 0 ? formatAmount(amount) + ' || ' : ' || -' + formatAmount(amount)} || ${formatAmount(amount)}
    }

export default operations =>
    [
        'date || credit || debit || balance',
        ...operations.map(formatOperation).reverse(),
    ].join('\n');