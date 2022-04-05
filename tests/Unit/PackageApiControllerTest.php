<?php


use App\Http\Controllers\PackageApiController;
use App\Models\Package;
use PHPUnit\Framework\TestCase;

class PackageApiControllerTest extends TestCase
{

    public function testGetNewPackageStatus() {
        //arrange
        $statusId = 1;
        $controller = new PackageApiController();
        //act
        $result = $controller->getNewPackageStatus(0, $statusId);
        //assert
        Self::assertEquals($statusId + 1, $result);
    }

    public function testGetNewPackageStatus2() {
        //arrange
        $statusId = 1;
        $newStatusId = 3;
        $controller = new PackageApiController();
        //act
        $result = $controller->getNewPackageStatus($newStatusId, $statusId);
        //assert
        Self::assertEquals($newStatusId, $result);
    }
}
