<div class="bothelp">
	
	
	
	
	
	<!--div class='panel'-->

		<div class="panel">

			<h3>There are only a few simple configurations.</h3>

			<ul class="faq_checkboxes">

				<li>
					Is Active
					<ul>
						<li>
							This setting determines whether or not the bot is actively trading.
						</li>
					</ul>
				</li>

				<li>
					Testing Mode
					<ul>
						<li>
							When in testing mode, the bot uses a test ledger for trading.
						</li>
						<li>
							When in testing mode, trades are free.
						</li>
						<li>
							No BitStamp credentials are required in order to use testing mode.
						</li>
					</ul>
				</li>

				<li>
					Auto Buy
					<ul>
						<li>
							This setting gives the bot permission to make a purchase when conditions have been met.
						</li>
						<li>
							Once the buy order has been created, this setting will be automatically disabled.
						</li>
					</ul>
				</li>

				<li>
					Auto Sell
					<ul>
						<li>
							This setting gives the bot permission to make a sale when conditions have been met.
						</li>
						<li>
							Once the sell order has been created, this setting will be automatically disabled.
						</li>
					</ul>
				</li>

				<li>
					Fixed Sell
					<ul>
						<li>
							This setting gives the bot permission to create a limit order.
						</li>
						<li>
							There is no guarantee that the limit order will be executed.
						</li>
						<li>
							Once the limit order has been created, this setting will be automatically disabled.
						</li>
					</ul>
				</li>

				<li>
					Fixed Buy
					<ul>
						<li>
							This setting gives the bot permission to create a limit order.
						</li>
						<li>
							There is no guarantee that the limit order will be executed.
						</li>
						<li>
							Once the limit order has been created, this setting will be automatically disabled.
						</li>
					</ul>
				</li>
			</ul>

			<ul class="faq_settings1">
				<li>
					Base
					<ul>
						<li>
							This is the price around which transactions are made.
						</li>
					</ul>
				</li>

				<li>
					% Increase
					<ul>
						<li>
							This is the % increase over the Base price at which a sell transaction will occur.
						</li>
					</ul>
				</li>

				<li>
					% Decrease
					<ul>
						<li>
							This is the % under the Base price at which a buy transaction will occur.
						</li>
					</ul>
				</li>

				<li>
					Sell Price
					<ul>
						<li>
							This is the price at which a sell limit order will be created.
						</li>
					</ul>
				</li>

				<li>
					Buy Price
					<ul>
						<li>
							This is the price at which a buy limit order will be created.
						</li>
					</ul>
				</li>
			</ul>

			<ul class="faq_settings2">

				<li>
					Margin Sale Price
					<ul>
						<li>
							This is the price at which a sell transaction will be generated
						</li>
						<li>
							Margin sale price is calculated automatically by combining the base and % increase.
						</li>
						<li>
							Margin sale prices are only approximations, and may vary slightly from Bitstamp calculations.
						</li>
					</ul>
				</li>

				<li>
					Margin Buy Price
					<ul>
						<li>
							This is the price at which a buy transaction will be generated
						</li>
						<li>
							Margin buy price is calculated automatically by combining the base and % increase.
						</li>
						<li>
							Margin buy prices are only approximations, and may vary slightly from Bitstamp calculations.
						</li>
					</ul>
				</li>

				<li>
					Sell Limit Btc
					<ul>
						<li>
							This is the maximum number of BTC that can be sold in a single transaction.
						</li>
						<li>
							If sell limit is set to zero, all available BTC will be sold in a single transaction.
						</li>
					</ul>
				</li>

				<li>
					Buy Limit Btc
					<ul>
						<li>
							This is the maximum number of BTC that can be sold in a single transaction.
						</li>
						<li>
							If buy limit is set to zero, all available USD will be used for the transaction.
						</li>
					</ul>
				</li>

			</ul>
		</div>

	<!--/div-->
</div>
