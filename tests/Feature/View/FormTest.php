<?php

it('can render', function () {
    $contents = $this->view('form', [
        //
    ]);

    $contents->assertSee('');
});
