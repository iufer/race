{table_open}<table class="race-calendar">{/table_open}
	
	{week_row_start}<tr>{/week_row_start}
		{week_day_cell}<th>{week_day}</th>{/week_day_cell}
	{week_row_end}</tr>{/week_row_end}

	{cal_row_start}<tr>{/cal_row_start}
		{cal_cell_start}{/cal_cell_start}
		{cal_cell_end}{/cal_cell_end}

		{cal_cell_content}
			<td class="active">			
				<header class="{class} {type_class}">
					{day} <span>{type}</span>
				</header>
				<div>
					<ol>{link_list}</ol>
				</div>
			</td>
		{/cal_cell_content}

		{cal_cell_content_today}
			<td class="highlight active">
				<header class="{class}">
					{day} <span>{type}</span>
				</header>
				<div>
					<ol>{link_list}</ol>
				</div>
			</td>
		{/cal_cell_content_today}

		{cal_cell_no_content_today}
			<td class="highlight">
				<header>{day}</header>
				<div><div>
			</td>
		{/cal_cell_no_content_today}

		{cal_cell_no_content}
			<td>
				<header>{day}</header>
				<div><div>
			</td>
		{/cal_cell_no_content}

		{cal_cell_blank}
			<td>
				<header>&nbsp;</header>
				<div><div>
			</td>
		{/cal_cell_blank}

	{cal_row_end}</tr>{/cal_row_end}

{table_close}</table>{/table_close}