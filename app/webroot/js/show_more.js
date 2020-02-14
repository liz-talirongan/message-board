
					function readMoreLinkText(text)
					{

							if (text == 'Read More') {	

								return 'Read Less';

							}else{
								return 'Read More';
							}

					}

					function readLess(element)
					{
						element.css({
							'height': '50px',
							'overflow':'hidden',
							'white-space':'nowrap'
						})
					}

					function readMore(element)
					{
						element.css({
							'height': 'auto',
							'overflow':'none',
							'white-space':'normal',
							'display':'inline-block'
						})
					}
