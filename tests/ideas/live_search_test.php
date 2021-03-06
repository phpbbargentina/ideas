<?php
/**
 *
 * Ideas extension for the phpBB Forum Software package.
 *
 * @copyright (c) phpBB Limited <https://www.phpbb.com>
 * @license GNU General Public License, version 2 (GPL-2.0)
 *
 */

namespace phpbb\ideas\tests\ideas;

class live_search_test extends \phpbb\ideas\tests\ideas\ideas_base
{
	public function live_search_data()
	{
		return [
			['Foo', [
				'Foo Idea #1 New with 3 up votes',
				'Foo Idea #3 In Progress with 1 up and 1 down vote',
			]],
			['bar', [
				'Bar Idea #2 New with 1 down vote',
				'Bar Idea #4 Implemented with 0 votes',
			]],
			['roved', [
				'Unapproved Idea #5 New with 0 votes',
			]],
			['xxx', []],
		];
	}

	/**
	 * @dataProvider live_search_data
	 */
	public function test_live_search($input, $expected)
	{
		$ideas = $this->get_ideas_object();

		$results = $ideas->ideas_title_livesearch($input);

		if (empty($expected))
		{
			$this->assertEmpty($results);
		}

		foreach ($results as $result)
		{
			$this->assertContains($result['clean_title'], $expected);
		}
	}
}
