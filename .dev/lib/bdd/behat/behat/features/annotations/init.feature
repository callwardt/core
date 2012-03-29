Feature: Init
  In order to be able to start fast
  As a feature developer
  I need to be able to init Behat path structure fast

  Scenario: Simple init
    Given I am in the "init_test" path
    When I run "behat --init"
    Then it should pass with:
      """
      +d features - place your *.feature files here
      +d features/bootstrap - place bootstrap scripts and static files here
      +f features/bootstrap/FeatureContext.php - place your feature related code here
      """
    And file "features/bootstrap/FeatureContext.php" should exist

  Scenario: In features path init
    Given I am in the "init_test/features" path
    When I run "behat --init"
    Then it should pass with:
      """
      +d bootstrap - place bootstrap scripts and static files here
      +f bootstrap/FeatureContext.php - place your feature related code here
      """
    And file "bootstrap/FeatureContext.php" should exist

  Scenario: In features path init
    Given I am in the "init_test" path
    When I run "behat --init public/behat/features/"
    Then it should pass with:
      """
      +d public/behat/features - place your *.feature files here
      +d public/behat/features/bootstrap - place bootstrap scripts and static files here
      +f public/behat/features/bootstrap/FeatureContext.php - place your feature related code here
      """
    And file "public/behat/features/bootstrap/FeatureContext.php" should exist

  Scenario: Custom paths
    Given I am in the "init_test2" path
    And a file named "behat.yml" with:
      """
      default:
        paths:
          features: scenarios
          bootstrap:  supp
      """
    When I run "behat --init"
    Then it should pass with:
      """
      +d scenarios - place your *.feature files here
      +d supp - place bootstrap scripts and static files here
      +f supp/FeatureContext.php - place your feature related code here
      """
    And file "supp/FeatureContext.php" should exist
