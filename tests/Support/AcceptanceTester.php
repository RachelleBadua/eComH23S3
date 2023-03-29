<?php

declare(strict_types=1);

namespace Tests\Support;

/**
 * Inherited Methods
 * @method void wantTo($text)
 * @method void wantToTest($text)
 * @method void execute($callable)
 * @method void expectTo($prediction)
 * @method void expect($prediction)
 * @method void amGoingTo($argumentation)
 * @method void am($role)
 * @method void lookForwardTo($achieveValue)
 * @method void comment($description)
 * @method void pause($vars = [])
 *
 * @SuppressWarnings(PHPMD)
*/
class AcceptanceTester extends \Codeception\Actor
{
    use _generated\AcceptanceTesterActions;

    /**
     * Define custom actions here
     */

    /**
     * @Given I am on Google
     */
     public function iAmOnGoogle()
     {
         // throw new \PHPUnit\Framework\IncompleteTestError("Step `I am on Google` is not defined");
     	$this->amOnPage("https://google.ca");
     }

    /**
     * @When I input :value in :fieldName
     */
     public function iInputIn($value, $fieldName)
     {
         // throw new \PHPUnit\Framework\IncompleteTestError("Step `I input :arg1 in :arg2` is not defined");
     	$this->fillField($fieldName, $value);
     }

    /**
     * @When I press :text
     */
     public function iPress($text)
     {
         // throw new \PHPUnit\Framework\IncompleteTestError("Step `I press :arg1` is not defined");
 		$this->click($text);
     }

    /**
     * @Then I see :text
     */
     public function iSee($text)
     {
         // throw new \PHPUnit\Framework\IncompleteTestError("Step `I see :arg1` is not defined");
     	$this->see($text);
     }

     /**
     * @Then I don't see :arg1
     */
     public function iDontSee($arg1)
     {
         // throw new \PHPUnit\Framework\IncompleteTestError("Step `I don't see :arg1` is not defined");
     	$this->dontSee($arg1);
     }

}
