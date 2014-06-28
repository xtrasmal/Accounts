Feature: Register an account
  In order to login
  As an unregistered user
  I need to be able to register an account
  Scenario: Registering with credentials
    Given I am on url "accounts/register"
    And I fill in my "Fullname"
    And I fill in a unique "Email"
    And I fill in my "Password"
    When I press "Register"
    Then I should be registered
