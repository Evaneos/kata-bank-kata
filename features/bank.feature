Feature: Be able to deposit and withdraw money
    In order to save my money
    As a customer
    I should be able to withdraw and deposit my money

Scenario: Deposit and withdraw
    Given a deposit of "1000" on "10-01-2012"
    And a deposit of "2000" on "13-01-2012"
    When a withdrawal of "500" on "14-01-2012"
    Then statement should be:
        | date | credit | debit | balance |
        | 14/01/2012 | 0.00 | 500.00 | 2500.00 |
        | 13/01/2012 | 2000.00 | 0.00 | 3000.00 |
        | 10/01/2012 | 1000.00 | 0.00 | 1000.00 |