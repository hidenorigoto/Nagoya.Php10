<?php

namespace Nagoya\Php10;

class Php10Test extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Php10
     */
    protected $Php10;

    protected function setUp()
    {
        $this->Php10 = new Php10();
    }

    /**
     * @dataProvider dataForTest
     */
    public function test($input, $expected)
    {
        $result = $this->Php10->run($input);
        $this->assertThat($result, $this->equalTo($expected));
    }

    public function dataForTest()
    {
        return [

            '1'=> [ "6:NABEbBZn", "-ZAB-E" ]
            ,'2'=> [ "1:A", "A" ]
            ,'3'=> [ "1:Aa", "-"  ]
            ,'4'=> [ "2:AB", "AB"  ]
            ,'5'=> [ "2:AaB", "B-"  ]
            ,'6'=> [ "2:AZa", "-Z"  ]
            ,'7'=> [ "2:AZz", "A-"  ]
            ,'8'=> [ "3:ABC", "ACB"  ]
            ,'9'=> [ "3:ABCa", "-CB"  ]
            ,'10'=> [ "4:ABCD", "ADBC"  ]
            ,'11'=> [ "4:ABCbBD", "ABDC"  ]
            ,'12'=> [ "4:ABCDabcA", "-D-A"  ]
            ,'13'=> [ "5:NEXUS", "NUESX"  ]
            ,'14'=> [ "5:ZYQMyqY", "ZM-Y-"  ]
            ,'15'=> [ "5:ABCDbdXYc", "AYX--"  ]
            ,'16'=> [ "6:FUTSAL", "FAULTS"  ]
            ,'17'=> [ "6:ABCDEbcBC", "AECB-D"  ]
            ,'18'=> [ "7:FMTOWNS", "FWMNTSO"  ]
            ,'19'=> [ "7:ABCDEFGabcdfXYZ", "YE-X-GZ"  ]
            ,'20'=> [ "10:ABCDEFGHIJ", "AGBHCIDJEF"  ]
        ];
    }
}
