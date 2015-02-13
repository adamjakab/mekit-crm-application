<?php
namespace Mekit\Bundle\AccountBundle\Tests\Functional;

use Mekit\Bundle\TestBundle\Helpers\MekitFunctionalTest;


class AccountControllerTest extends MekitFunctionalTest {

	protected function setUp() {
		$this->initClient([], $this->generateBasicAuthHeader());
	}

	public function testIndexAction() {
		$this->client->request('GET', $this->getUrl('mekit_account_index',[]));
		$result = $this->client->getResponse();
		$this->assertTrue($result->isOk());
	}
}