<?php

namespace AppBundle\Features\Context;

use Behat\Behat\Context\Context;
use Behat\Behat\Context\SnippetAcceptingContext;
use Behat\Behat\Tester\Exception\PendingException;
use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;
use Doctrine\ORM\EntityManager;

/**
 * Defines generic application testing features
 */
class BaseContext implements Context
{
    use \Behat\Symfony2Extension\Context\KernelDictionary;

    /**
     * Initializes context.
     */
    public function __construct()
    {
    }

    /**
     * @AfterFeature
     */
    public static function postFeature()
    {
    }

    public static function postScenario()
    {
        echo "- - - - - - After Scenario - - - - - - \n";
    }

    /**
     * @BeforeSuite
     */
    public static function bootstrapSuite()
    {
        echo "- - - - - - Bootstrap Suite! - - - - - - \n";
        require_once __DIR__ . '/../../../../vendor/autoload.php';
        self::refreshDatabase();
    }

    /**
     * @AfterSuite
     */
    public static function tearDown()
    {
        echo "- - - - - - Tear it Down! - - - - - - \n";
    }

    /**
     * @BeforeScenario
     */
    public static function refreshDatabase()
    {
        echo "- - - - - - Refresh Database! - - - - - - \n";
        exec('php bin/console -e=acceptance doctrine:database:drop --force');
        exec('php bin/console -e=acceptance doctrine:database:create');
        exec('php bin/console -e=acceptance doctrine:schema:update --force');
    }

    /**
     * Pauses the scenario until the user presses a key. Useful when debugging a scenario.
     *
     * @Then halt
     */
    public function halt()
    {
        fwrite(STDOUT, "\033[s    \033[93m[Breakpoint] Press \033[1;93m[RETURN]\033[0;93m to continue...\033[0m");
        while (fgets(STDIN, 1024) == '') {}
        fwrite(STDOUT, "\033[u");

        return;
    }

}