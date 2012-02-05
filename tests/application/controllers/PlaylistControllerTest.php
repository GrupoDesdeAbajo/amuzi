<?php

require_once 'bootstrap.php';

class PlaylistControllerTest extends DZend_Test_PHPUnit_ControllerTestCase
{
    /**
     * testLoggedOutIndex
     *
     * @return void
     */
    public function testLoggedOutIndex()
    {
        $this->assertAjax500('/playlist/index');
    }

    /**
     * testLoggedOutSearch
     *
     * @return void
     */
    public function testLoggedOutSearch()
    {
        $this->assertAjax500('/playlist/search');
    }

    public function testLoggedOutSave()
    {
        $this->assertAjax500('/playlist/save');
    }

    public function testLoggedOutaddtrack()
    {
        $this->assertAjax500('/playlist/addtrack');
    }

    public function testLoggedOutrmtrack()
    {
        $this->assertAjax500('/playlist/rmtrack');
    }

    public function testLoggedOutload()
    {
        $this->assertAjax500('/playlist/load');
    }

    public function testLoggedOutsetrepeat()
    {
        $this->assertAjax500('/playlist/setrepeat');
    }

    public function testLoggedOutsetshuffle()
    {
        $this->assertAjax500('/playlist/setshuffle');
    }

    public function testLoggedOutsetcurrent()
    {
        $this->assertAjax500('/playlist/setcurrent');
    }

    public function testLoggedOutnew()
    {
        $this->assertAjax500('/playlist/new');
    }

    /**
     * testIndexAction
     *
     * @return void
     */
    public function testIndexAction()
    {
        User::loginDummy();
        $this->assertAjaxWorks('/playlist');
        $this->assertBasics('index', 'playlist');
        $this->assertQuery('form#playlistsettings');
        $this->assertQuery('form#playlistsettings input#q');
        $this->assertQuery('form#playlistsettings input#submit');
    }

    public function testSearchAction()
    {
        User::loginDummy();
        $this->request->setMethod('POST');
        $this->assertAjaxWorks('/playlist/search');
        $this->assertQueryCount('tr', 3);
        $this->assertQueryCount('tr td img', 3);
        $this->assertQueryCount('tr td', 9);
    }

    public function testSearchAction2()
    {
        User::loginDummy();
        $this->request->setMethod('POST');
        $this->request->setPost(array('q' => 'newOne'));
        $this->assertAjaxWorks('/playlist/search');
        $this->assertQueryCount('tr', 1);
        $this->assertQueryCount('tr td img', 1);
        $this->assertQueryCount('tr td', 3);
    }

    public function testSearchAction3()
    {
        User::loginDummy();
        $this->request->setMethod('GET');
        $this->request->setParams(array('q' => 'newOne'));
        $this->assertAjax500('/playlist/search');
        $this->assertEquals(
            $this->response->getBody(), "<span>Error: Invalid request</span>"
        );
    }
}
