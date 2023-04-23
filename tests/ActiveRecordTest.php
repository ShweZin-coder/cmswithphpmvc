<?php declare(strict_types=1);
use PHPUnit\Framework\TestCase;
require_once('src/Entity.php');
require_once('modules/page/models/Page.php');

class FakeStmt{
    function execute()
    {

    }
    function fetchAll()
    {
        return [
            [
                'id' => 1, 'title' => 'fake', 'content' => 'fake content'
            ],
            [
                'id' => 2, 'title' => 'fake 1', 'content' => 'fake content 1'
            ],
        ];
    }
}

class FakeDatabaseConnection
{
    function prepare()
    {
       return new FakeStmt();
    }
}
final class ActiveRecordTest extends TestCase
{
    public function testFindBy(): void
    {
        $dbc = new FakeDatabaseConnection();
        $page = new Page($dbc);
        $page->findBy('id',2);
        $this->assertEquals(2,$page->id);
    }
}

