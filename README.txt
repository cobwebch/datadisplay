This is a very rough explanation of how this plug-in runs. It may not be enough to be able to use it fully.

This extension adds a new content element type able to display data coming from any possible source, as long as it is provided in a standardised data structure, such as created by extension "dataquery". Such a standardised data structure looks like this:

array(
	'name' => 'maintable',
	'records' => array(
		...
		'subtables' => array(
			'name' => 'subtable',
			'records' => array(
				...
			)
		)
	)
)

Currently the rendering can only be done in TypoScript. Rendering TypoScripts are defined inside the plug-in's "config" property. Any number of such renderings can be defined. The static template provides a default rendering:

plugin.tx_datadisplay_pi1 {
	configs.default {
		allWrap.wrap = <table cellpadding="0" cellspacing="0" border="0">|</table>
		row.wrap = <tr>|</tr>
		field.wrap = <td>|</td>
		section = 0
	}
}

As you can see, it is simply called "default". A specific rendering would have to  match the name of the alias given for the main table table in the dataquery extension (for example, if you have the following query: SELECT * FROM mytable AS foobar, use "foobar"). The default rendering simply wraps each record in the dataset in a table row and each column in a table cell. This whole construct is then wrapped inside a table tag.

Instead of having such a generic rendering, it is possible to be finer, since the data from the current record is always loaded into the content object used for rendering. As such you can avoid using the "field" property entirely and use the "row" instead. Example:

plugin.tx_datadisplay_pi1 {
	configs.foobar {
		allWrap.wrap = <table cellpadding="0" cellspacing="0" border="0">|</table>
		row.cObject = COA
		row.cObject {
			10 = TEXT
			10.field = my_field_1
			10.wrap = <td>|</td>
			20 = TEXT
			20.field = my_field_2
			20.wrap = <td>|</td>
			wrap = <tr>|</tr>
		}
		field >
	}
}

It is possible to display joined records from subtables, by calling the plug-in recursively. Example:

plugin.tx_datadisplay_pi1 {
	configs.foobar {
		allWrap.wrap = <table cellpadding="0" cellspacing="0" border="0">|</table>
		row.cObject = COA
		row.cObject {
			10 = TEXT
			10.field = my_field_1
			10.wrap = <td>|</td>
			20 = TEXT
			20.field = my_field_2
			20.wrap = <td>|</td>
			wrap = <tr>|</tr>
			30 < plugin.tx_datadisplay_pi1
			30.userFunc = tx_datadisplay_pi1->sub
			30 {
				name = subtable
				configs >
				configs.subtable {
					...
				}
			}
		}
		field >
	}
}

As you can see it is simply a question of copying the plug-in itself and changing the userFunc to call sub() instead of main(). This avoids redoing the whole initialisation process. The "name" property is supposed to refer to a specific subtable, but since it is hard-coded, it's only possible to have a single subtable for now.

It is also possible to group data by "sections" and have a special display each time the section changes. The query created in dataquery must be ORDERed BY correctly for the display to be clean (records are not ordered by datadisplay). Example:

plugin.tx_datadisplay_pi1 {
	configs.foobar {
		allWrap.wrap = <table cellpadding="0" cellspacing="0" border="0">|</table>
		row.cObject = COA
		row.cObject {
			...
		}
		field >
		section = 1
		section {
			field = my_section_field
			wrap = <h2>|</h2>
		}
	}
}

First the section display must be activated (section = 1), then the rendering of the section is defined, as a stdWrap.