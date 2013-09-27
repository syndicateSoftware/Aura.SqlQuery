<?php
namespace Aura\Sql_Query\Sqlsrv;

use Aura\Sql_Query\Common\SelectTest as CommonSelectTest;

class SelectTest extends CommonSelectTest
{
    protected $db_type = 'sqlsrv';

    public function testLimitOffset()
    {
        $this->query->limit(10);
        $expect = '
            SELECT TOP 10
        ';
        $actual = $this->query->__toString();
        $this->assertSameSql($expect, $actual);
        
        $this->query->offset(40);
        $expect = '
            SELECT
            OFFSET 40 ROWS FETCH NEXT 10 ROWS ONLY
        ';
        $actual = $this->query->__toString();
        $this->assertSameSql($expect, $actual);
    }
    
    public function testPage()
    {
        $this->query->page(5);
        $expect = '
            SELECT
            OFFSET 40 ROWS FETCH NEXT 10 ROWS ONLY
        ';
        $actual = $this->query->__toString();
        $this->assertSameSql($expect, $actual);
    }
}
