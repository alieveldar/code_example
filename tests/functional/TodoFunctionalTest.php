<?php

class TodoFunctionalTest extends \Codeception\Test\Unit
{
    /**
     * @var \FunctionalTester
     */
    protected $tester;

    public function testOptimisticLockForTwoUsersEdit()
    {

        $this->tester->amOnPage('/');
        $this->tester->click('.btn.btn-success[href="/create"]');
        $this->tester->seeElement('#todosearch-title');
        $this->tester->fillField('#todosearch-title', 'Новая задача');
        $this->tester->fillField('input[name="TodoSearch[priority]"]', '5');
        $this->tester->click('Save');

        $todoId = $this->getTodoId($this->tester);

        $this->tester->seeCurrentUrlEquals("/view/{$todoId}");
        $this->tester->click('Update');
        $this->tester->checkOption('#todo-done');
        $this->tester->seeCheckboxIsChecked('#todo-done');

        $todoModelFromDB = \app\models\Todo::findOne($todoId);
        $todoModelFromDB->title = 'New ToDo';
        $todoModelFromDB->save();

        $this->tester->click('Save');
        $this->tester->see('Conflict, item was changed by another user, your changes will be lost.');
    }

    public function testOptimisticLockForUserAndApi()
    {
        $this->tester->amOnPage('/');
        $this->tester->click('.btn.btn-success[href="/create"]');
        $this->tester->seeElement('#todosearch-title');
        $this->tester->fillField('#todosearch-title', 'Новая задача');
        $this->tester->fillField('input[name="TodoSearch[priority]"]', '5');
        $this->tester->click('Save');

        $todoId = $this->getTodoId($this->tester);

        $this->tester->amOnPage("/update/{$todoId}");
        $this->tester->fillField('#todo-priority', '8');
        $this->tester->haveHttpHeader('Content-Type', 'application/json');
        $this->tester->sendAjaxRequest("PUT", "/api/todo/{$todoId}", [
            'done' => 1
        ]);

        $this->tester->seeResponseCodeIs(200);
        $todoModelFromDB = \app\models\Todo::findOne($todoId);
        $this->tester->assertEquals(1, $todoModelFromDB->done);
        $this->tester->click('Save');
        $this->tester->dontSee('Conflict, item was changed by another user, your changes will be lost.');
        $todoModelFromDB = \app\models\Todo::findOne($todoId);
        $this->tester->assertEquals(0, $todoModelFromDB->done);



    }
    private function getTodoId()
    {
        $id = $this->tester->grabFromCurrentUrl('~\/view\/(\d+)~');
        return $id;
    }

}