<?php


use App\Http\Controllers\PackageApiController;
use App\Models\Package;
use PHPUnit\Framework\TestCase;

class PackageApiControllerTest extends TestCase
{

    public function testGetNewPackageStatus() {
        //arrange
        $statusId = 1;
        $package = new Package();
        $package->status_id = $statusId;
        $controller = new PackageApiController();
        //act
        $result = $controller->getNewPackageStatus(0, $package);
        //assert
        Self::assertEquals($statusId + 1, $result);
    }

    public function testGetNewPackageStatus2() {
        //arrange
        $statusId = 1;
        $newStatusId = 3;
        $package = new Package();
        $package->status_id = $statusId;
        $controller = new PackageApiController();
        //act
        $result = $controller->getNewPackageStatus($newStatusId, $package);
        //assert
        Self::assertEquals($newStatusId, $result);
    }
}
